/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   paths.c                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/22 16:22:00 by malallai          #+#    #+#             */
/*   Updated: 2019/03/22 16:22:00 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <ft_ls.h>

int		is_parent_path(char *str)
{
	return (str[0] == '.' || (str[0] == '.' && str[1] == '.'));
}

int		to_folder(char *name, char *entry_name)
{
	char	*tmp;
	char	*tmp2;
	int		r;

	r = 0;
	if (name[ft_strlen(name) - 1] == '/')
		r = 0;
	else
	{
		tmp2 = ft_strjoin(entry_name ? entry_name : "", name);
		if (is_regular_file(tmp2))
		{
			free(tmp2);
			return (0);
		}
		tmp = ft_strjoin(name, "/");
		tmp2 = ft_strjoin(entry_name ? entry_name : "", tmp);
		if (!is_regular_file(tmp2) && is_folder(tmp2))
			r = 1;
		free(tmp);
		free(tmp2);
	}
	return (r);
}

char	*join_path(char *str1, char *str2)
{
	char *tmp;
	char *tmp2;

	tmp = ft_strdup(str1);
	tmp2 = ft_strjoin(tmp, "/");
	free(tmp);
	tmp = ft_strjoin(tmp2, str2);
	free(tmp2);
	return (tmp);
}

char	*get_path(char *parent, char *file)
{
	char *tmp;

	if (!parent)
		return (file);
	if (parent[ft_strlen(parent) - 1] == '/')
	{
		tmp = ft_strjoin(parent, file);
		return (tmp);
	}
	tmp = ft_strjoin(parent, "/");
	return (ft_strcat(tmp, file));
}
