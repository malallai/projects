/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_count_if.c                                      :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/06 14:21:51 by malallai          #+#    #+#             */
/*   Updated: 2018/11/06 14:22:20 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

int		ft_count_if(char **tab, int (*f)(char *))
{
	int i;
	int j;

	i = -1;
	j = 0;
	while (tab[++i])
		if (f(tab[i]) == 1)
			j++;
	return (j);
}
