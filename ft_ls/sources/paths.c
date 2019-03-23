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
