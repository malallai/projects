/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strtrim.c                                       :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/12 12:12:17 by malallai          #+#    #+#             */
/*   Updated: 2018/11/12 18:15:40 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

static int		ft_isspace(char c)
{
	if (c == ' ' || c == '\n' || c == '\t'
		|| c == '\f' || c == '\v' || c == '\r')
		return (1);
	else
		return (0);
}

char	*ft_strtrim(char const *s)
{
	char	*new;
	int		i;
	int		j;

	if (!s)
		return (NULL);
	i = 0;
	while (s[i] && ft_isspace(s[i]))
		i++;
	j = ft_strlen(s) - 1;
	while (s[i] && ft_isspace(s[j]))
		j--;
	new = ft_strsub(s, i, j - i + 1);

	return (new);
}
